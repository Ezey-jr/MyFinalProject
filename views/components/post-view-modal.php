<!-- ═══════════ POST VIEWING MODAL COMPONENT ═══════════ -->
<!-- Include this in posts.php before closing </body> -->

<div class="modal-overlay" id="postModal">
  <div class="modal-container">
    <!-- Header -->
    <div class="modal-header">
      <h2 class="modal-title" id="modalTitle">Post Title</h2>
      <button class="modal-close-btn" id="modalCloseBtn" title="Close modal">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
      </button>
    </div>

    <!-- Body -->
    <div class="modal-body">
      <!-- Featured Image Placeholder -->
      <div class="modal-featured-image">
        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
          <circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/>
        </svg>
      </div>

      <!-- Meta Information -->
      <div class="modal-meta-info">
        <div class="modal-meta-item">
          <span class="modal-meta-label">Author:kenneth</span>
          <strong id="modalAuthor">—</strong>
        </div>
        <div class="modal-meta-item">
          <span class="modal-meta-label">Date:january 1</span>
          <strong id="modalDate">—</strong>
        </div>
        <div class="modal-meta-item">
          <span class="modal-meta-label">Views:</span>
          <strong id="modalViews">0</strong>
        </div>
        <div class="modal-meta-item">
          <span class="modal-meta-label">Category:</span>
          <strong id="modalCategory">—</strong>
        </div>
        <div class="modal-meta-item">
          <span class="modal-status-badge" id="modalStatusBadge">draft</span>
        </div>
      </div>

      <!-- Excerpt -->
      <div class="modal-excerpt" id="modalExcerpt"></div>

      <!-- Post Body -->
      <div class="modal-post-body" id="modalBody"></div>
    </div>

    <!-- Footer -->
    <div class="modal-footer">
      <button class="modal-btn secondary" id="modalCloseFooterBtn">Close</button>
      <a href="#" class="modal-btn primary" id="modalEditBtn">Edit Post</a>
    </div>
  </div>
</div>
