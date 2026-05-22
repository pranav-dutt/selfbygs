/* SELF by GS · Forms Manager · Admin JS */
/* global selfbygsFormsAdmin, jQuery, Sortable */
(function ($) {
  'use strict';

  var cfg = window.selfbygsFormsAdmin || {};
  var ajaxUrl = cfg.ajaxUrl || ajaxurl;
  var nonce   = cfg.nonce   || '';

  // ── Inline status change (entries list + detail) ──────────────────
  $(document).on('change', '.sbgs-status-select', function () {
    var $sel = $(this);
    var entryId = $sel.data('id');
    var status  = $sel.val();
    $.post(ajaxUrl, {
      action   : 'selfbygs_update_status',
      nonce    : nonce,
      entry_id : entryId,
      status   : status,
    }).fail(function () {
      alert('Status update failed. Please try again.');
    });
  });

  // ── Delete entry ──────────────────────────────────────────────────
  $(document).on('click', '.sbgs-delete-btn', function () {
    var $btn      = $(this);
    var entryId   = $btn.data('id');
    var redirect  = $btn.data('redirect') || '';
    if (!confirm(cfg.strings && cfg.strings.confirmDelete ? cfg.strings.confirmDelete : 'Delete this entry? This cannot be undone.')) return;
    $.post(ajaxUrl, {
      action   : 'selfbygs_delete_entry',
      nonce    : nonce,
      entry_id : entryId,
    }, function (res) {
      if (res.success) {
        if (redirect) {
          window.location = redirect;
        } else {
          var $row = $btn.closest('tr.sbgs-row');
          if ($row.length) {
            $row.fadeOut(200, function () { $row.remove(); });
          }
        }
      } else {
        alert('Delete failed.');
      }
    });
  });

  // ── Add note (entry detail) ───────────────────────────────────────
  $('#sbgs-save-note').on('click', function () {
    var $btn    = $(this);
    var entryId = $btn.data('id');
    var noteNonce = $btn.data('nonce') || nonce;
    var note    = $('#sbgs-note-input').val().trim();
    if (!note) return;
    $btn.prop('disabled', true).text('Saving…');
    $.post(ajaxUrl, {
      action   : 'selfbygs_add_note',
      nonce    : noteNonce,
      entry_id : entryId,
      note     : note,
    }, function (res) {
      $btn.prop('disabled', false).text('Add Note');
      if (res.success) {
        var now = new Date().toLocaleString('en-GB', { day:'numeric', month:'short', year:'numeric', hour:'numeric', minute:'2-digit' });
        var html = '<div class="sbgs-note">' +
          '<p class="sbgs-note-text">' + escHtml(note).replace(/\n/g, '<br>') + '</p>' +
          '<div class="sbgs-note-meta">You &middot; ' + escHtml(now) + '</div>' +
          '</div>';
        $('#sbgs-notes-list .sbgs-no-notes').remove();
        $('#sbgs-notes-list').append(html);
        $('#sbgs-note-input').val('');
      }
    }).fail(function () {
      $btn.prop('disabled', false).text('Add Note');
      alert('Note save failed.');
    });
  });

  // ── Send reply (entry detail) ─────────────────────────────────────
  $('#sbgs-send-reply').on('click', function () {
    var $btn    = $(this);
    var entryId = $btn.data('id');
    var replyNonce = $btn.data('nonce') || nonce;
    var subject = $('#sbgs-reply-subject').val().trim();
    var body    = '';

    // Try to get TinyMCE content first
    if (window.tinyMCE && tinyMCE.get('sbgs-reply-body')) {
      body = tinyMCE.get('sbgs-reply-body').getContent();
    } else {
      body = $('#sbgs-reply-body').val() || '';
    }

    if (!subject || !body) {
      alert('Please fill in subject and message body.');
      return;
    }
    $btn.prop('disabled', true).text('Sending…');
    $('#sbgs-reply-msg').text('').css('color', '');

    $.post(ajaxUrl, {
      action   : 'selfbygs_send_reply',
      nonce    : replyNonce,
      entry_id : entryId,
      subject  : subject,
      body     : body,
    }, function (res) {
      $btn.prop('disabled', false).html('Send Email Reply <span class="sbgs-arrow">→</span>');
      if (res.success) {
        $('#sbgs-reply-msg').text(cfg.strings && cfg.strings.replySent ? cfg.strings.replySent : 'Reply sent.').css('color', '#27ae60');
        // auto-update status badge on page
        $('.sbgs-status-badge').text('Replied').removeClass().addClass('sbgs-status-badge status-replied');
        $('.sbgs-status-select, #sbgs-status-main').val('replied');
      } else {
        $('#sbgs-reply-msg').text(res.data || 'Send failed.').css('color', '#c0392b');
      }
    }).fail(function () {
      $btn.prop('disabled', false).html('Send Email Reply <span class="sbgs-arrow">→</span>');
      $('#sbgs-reply-msg').text('Network error.').css('color', '#c0392b');
    });
  });

  // ── Form Settings: save ───────────────────────────────────────────
  $('#sbgs-save-settings').on('click', function () {
    var $btn   = $(this);
    var formId = $('#sbgs-form-settings-form').data('form-id');
    var settingsNonce = $('#sbgs-form-settings-form').data('nonce');
    var data   = $('#sbgs-form-settings-form').serializeArray();
    data.push({ name: 'action', value: 'selfbygs_save_form_settings' });
    data.push({ name: 'nonce',  value: settingsNonce });
    data.push({ name: 'form_id', value: formId });

    $btn.prop('disabled', true).html('Saving… <span class="sbgs-arrow">→</span>');
    $.post(ajaxUrl, data, function (res) {
      $btn.prop('disabled', false).html('Save Settings <span class="sbgs-arrow">→</span>');
      var msg = res.success
        ? (cfg.strings && cfg.strings.settingsSaved ? cfg.strings.settingsSaved : 'Settings saved.')
        : (res.data || 'Save failed.');
      $('#sbgs-save-msg').text(msg).css('color', res.success ? '#27ae60' : '#c0392b');
      setTimeout(function () { $('#sbgs-save-msg').text(''); }, 3000);
    }).fail(function () {
      $btn.prop('disabled', false).html('Save Settings <span class="sbgs-arrow">→</span>');
      $('#sbgs-save-msg').text('Network error.').css('color', '#c0392b');
    });
  });

  // ── Form Settings: inline field editor ───────────────────────────
  var $editor    = $('#sbgs-field-editor');
  var activeIndex = null;

  $(document).on('click', '.sbgs-edit-field-btn', function () {
    var $row = $(this).closest('.sbgs-field-row');
    activeIndex = $row.data('index');
    var key         = $row.find('[name$="[key]"]').val();
    var type        = $row.find('[name$="[type]"]').val();
    var label       = $row.find('[name$="[label]"]').val();
    var placeholder = $row.find('[name$="[placeholder]"]').val();
    var options     = [];
    $row.find('[name$="[options][]"]').each(function () { options.push($(this).val()); });

    $('#sfe-key').val(key);
    $('#sfe-type').val(type);
    $('#sfe-label').val(label);
    $('#sfe-placeholder').val(placeholder);
    $('#sfe-options').val(options.join('\n'));
    toggleOptionsField(type);

    $editor.slideDown(150);
    $editor[0].scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  });

  $('#sfe-type').on('change', function () { toggleOptionsField($(this).val()); });

  function toggleOptionsField(type) {
    var needsOptions = ['select', 'chips', 'radio', 'checkbox'].indexOf(type) !== -1;
    $('#sfe-options-wrap').toggle(needsOptions);
  }

  $('#sfe-apply').on('click', function () {
    if (activeIndex === null) return;
    var $row = $('.sbgs-field-row[data-index="' + activeIndex + '"]');
    var key         = $('#sfe-key').val().trim().replace(/\s+/g, '_');
    var type        = $('#sfe-type').val();
    var label       = $('#sfe-label').val().trim();
    var placeholder = $('#sfe-placeholder').val().trim();
    var options     = $('#sfe-options').val().split('\n').map(function (o) { return o.trim(); }).filter(Boolean);

    $row.find('[name$="[key]"]').val(key);
    $row.find('[name$="[type]"]').val(type);
    $row.find('[name$="[label]"]').val(label);
    $row.find('[name$="[placeholder]"]').val(placeholder);
    $row.find('.sbgs-field-row-key').text(key);
    $row.find('.sbgs-field-row-type').text(type);
    $row.find('.sbgs-field-row-name').text(label);

    // Rebuild options hidden inputs
    $row.find('[name$="[options][]"]').remove();
    options.forEach(function (opt) {
      $row.append($('<input>').attr({ type: 'hidden', name: 'fields[' + activeIndex + '][options][]', value: opt }));
    });

    $editor.slideUp(150);
    activeIndex = null;
  });

  $('#sfe-cancel').on('click', function () {
    $editor.slideUp(150);
    activeIndex = null;
  });

  // ── Form Settings: drag-to-reorder (SortableJS) ───────────────────
  var listEl = document.getElementById('sbgs-fields-list');
  if (listEl && window.Sortable) {
    Sortable.create(listEl, {
      handle: '.sbgs-drag-handle',
      animation: 150,
      ghostClass: 'sortable-ghost',
      chosenClass: 'sortable-chosen',
      onEnd: function () {
        listEl.querySelectorAll('.sbgs-field-row').forEach(function (row, i) {
          row.dataset.index = i;
          row.querySelectorAll('[name]').forEach(function (el) {
            el.name = el.name.replace(/^fields\[\d+\]/, 'fields[' + i + ']');
          });
        });
      },
    });
  }

  // ── Email Templates: save ─────────────────────────────────────────
  $('#sbgs-save-email-tpl').on('click', function () {
    var $btn  = $(this);
    var tplId = $('#sbgs-email-tpl-form').data('template-id');
    var tplNonce = $('#sbgs-email-tpl-form').data('nonce');
    var subject = $('#sbgs-tpl-subject').val().trim();
    var body    = '';

    if (window.tinyMCE && tinyMCE.get('sbgs-tpl-body')) {
      body = tinyMCE.get('sbgs-tpl-body').getContent();
    } else {
      body = $('#sbgs-tpl-body').val() || '';
    }

    $btn.prop('disabled', true).html('Saving… <span class="sbgs-arrow">→</span>');
    $.post(ajaxUrl, {
      action      : 'selfbygs_save_email_template',
      nonce       : tplNonce,
      template_id : tplId,
      subject     : subject,
      body        : body,
    }, function (res) {
      $btn.prop('disabled', false).html('Save Template <span class="sbgs-arrow">→</span>');
      var msg = res.success ? 'Template saved.' : (res.data || 'Save failed.');
      $('#sbgs-tpl-save-msg').text(msg).css('color', res.success ? '#27ae60' : '#c0392b');
      setTimeout(function () { $('#sbgs-tpl-save-msg').text(''); }, 3000);
    }).fail(function () {
      $btn.prop('disabled', false).html('Save Template <span class="sbgs-arrow">→</span>');
    });
  });

  // ── Email preview modal ───────────────────────────────────────────
  $('#sbgs-preview-email').on('click', function () {
    var subject = $('#sbgs-tpl-subject').val();
    var body    = '';
    if (window.tinyMCE && tinyMCE.get('sbgs-tpl-body')) {
      body = tinyMCE.get('sbgs-tpl-body').getContent();
    } else {
      body = $('#sbgs-tpl-body').val() || '';
    }
    var doc = $('#sbgs-preview-frame')[0].contentDocument;
    doc.open();
    doc.write('<!DOCTYPE html><html><head><meta charset="UTF-8"><style>body{font-family:sans-serif;padding:20px;max-width:640px;margin:0 auto;color:#1a1a1a;}</style></head><body>');
    doc.write('<p style="font-size:12px;color:#999;border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:20px;"><strong>Subject:</strong> ' + escHtml(subject) + '</p>');
    doc.write(body);
    doc.write('</body></html>');
    doc.close();
    $('#sbgs-preview-modal').fadeIn(150);
  });
  $(document).on('click', '.sbgs-modal-backdrop, .sbgs-modal-close', function () {
    $('#sbgs-preview-modal').fadeOut(150);
  });

  // ── Token click-to-copy ───────────────────────────────────────────
  $(document).on('click', '.sbgs-token', function () {
    var token = $(this).text();
    if (navigator.clipboard) {
      navigator.clipboard.writeText(token);
    }
    var $t = $(this);
    $t.css('background', '#c9a84c').css('color', '#fff');
    setTimeout(function () { $t.css('background', '').css('color', ''); }, 800);
  });

  // ── Utility ───────────────────────────────────────────────────────
  function escHtml(s) {
    return String(s)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

}(jQuery));
