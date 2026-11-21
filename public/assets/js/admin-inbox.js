document.querySelectorAll('[data-mark-read]').forEach((button) => {
  button.addEventListener('click', async () => {
    const message = button.closest('[data-message-id]');
    const requestId = message?.dataset.messageId;
    if (!message || !requestId) return;

    button.disabled = true;
    button.textContent = 'Mise à jour...';
    const formData = new FormData();
    formData.set('request_id', requestId);
    formData.set('csrf_token', document.querySelector('meta[name="csrf-token"]')?.content || '');

    try {
      const response = await fetch('/api/admin/messages/read', {
        method: 'POST',
        headers: {
          'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.content || '',
        },
        body: formData,
      });
      const result = await response.json();
      if (!response.ok || !result.success) {
        throw new Error(result.error || 'Le statut du message n’a pas pu être mis à jour.');
      }

      message.dataset.read = '1';
      message.classList.remove('border-np-accent/50', 'shadow-md', 'shadow-np-accent/5');
      message.classList.add('border-np-border');
      const status = message.querySelector('[data-message-status]');
      if (status) {
        status.textContent = 'Lu';
        status.classList.remove('text-np-accent');
        status.classList.add('text-np-text-muted');
      }
      button.remove();

      const count = document.getElementById('unread-count');
      if (count) count.textContent = String(result.unread_count);
      const notificationText = document.querySelector('#inbox-notification span:nth-child(2)');
      if (notificationText) {
        const unreadCount = Number(result.unread_count);
        notificationText.textContent = `${unreadCount} message${unreadCount === 1 ? '' : 's'} non lu${unreadCount === 1 ? '' : 's'}`;
      }
      const header = document.getElementById('site-header');
      if (header) header.dataset.adminUnreadCount = String(result.unread_count);
      document.querySelectorAll('[data-admin-unread-badge]').forEach((badge) => {
        badge.textContent = String(result.unread_count);
        badge.classList.toggle('hidden', result.unread_count < 1);
      });
    } catch (error) {
      console.error('Unable to mark message as read:', error);
      button.disabled = false;
      button.textContent = 'Réessayer';
      button.title = error instanceof Error ? error.message : 'Une erreur est survenue.';
    }
  });
});
