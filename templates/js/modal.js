/**
 * Opens the post viewing modal with post data
 * @param {Object} postData - Post object with id, title, excerpt, body, author, date, category, status, views
 */

function openPostModal(postData) {
  const modal = document.getElementById('postModal');
  if (!modal) return;

  // Populate modal content
  document.getElementById('modalTitle').textContent = postData.title;
  document.getElementById('modalAuthor').textContent = postData.author || 'Unknown';
  document.getElementById('modalDate').textContent = postData.date || 'N/A';
  document.getElementById('modalViews').textContent = postData.views > 0 ? postData.views.toLocaleString() : '0';
  document.getElementById('modalCategory').textContent = postData.category || 'Uncategorized';

  // Update status badge
  const statusBadge = document.getElementById('modalStatusBadge');
  statusBadge.textContent = postData.status || 'draft';
  statusBadge.className = 'modal-status-badge ' + (postData.status || 'draft');

  // Set excerpt and body (body supports HTML)
  document.getElementById('modalExcerpt').textContent = postData.excerpt || '';
  document.getElementById('modalBody').innerHTML = postData.body || '';

  // Update Edit button link
  const editBtn = document.getElementById('modalEditBtn');
  editBtn.href = 'edit-post.php?id=' + postData.id;

  // Show modal with animation
  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
}

/**
 * Closes the post viewing modal with animation
 */
function closePostModal() {
  const modal = document.getElementById('postModal');
  if (!modal) return;

  modal.classList.add('closing');

  setTimeout(() => {
    modal.classList.remove('open', 'closing');
    document.body.style.overflow = '';
  }, 300);
}

/**
 * Initialize modal event listeners (call on DOMContentLoaded)
 */
function initPostModal() {
  const modal = document.getElementById('postModal');
  if (!modal) return;

  const closeBtn = document.getElementById('modalCloseBtn');
  const closeFooterBtn = document.getElementById('modalCloseFooterBtn');

  // Close button (X)
  if (closeBtn) {
    closeBtn.addEventListener('click', closePostModal);
  }

  // Escape key to close
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal.classList.contains('open')) {
      closePostModal();
    }
  });

  // Close footer button
  if (closeFooterBtn) {
    closeFooterBtn.addEventListener('click', closePostModal);
  }
}

// Initialize on page load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initPostModal);
} else {
  initPostModal();
}
