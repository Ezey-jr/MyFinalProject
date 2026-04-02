/**
 * Opens the post viewing modal with post data
 * @param {Object} postData - Post object with id, title, excerpt, body, author, date, category, status, views
 */
const id = (id) => document.getElementById(id);
const qa = (qa) => document.querySelectorAll(qa);

const Element = {
  modal: {
    postModal: id('postModal'),
    modalTitle: id('modalTitle'),
    modalAuthor: id('modalAuthor'),
    modalDate: id('modalDate'),
    modalViews: id('modalViews'),
    modalCategory: id('modalCategory'),
    modalStatusBadge: id('modalStatusBadge'),
    modalExcerpt: id('modalExcerpt'),
    modalBody: id('modalBody'),
    modalEditBtn: id('modalEditBtn'),
    modalCloseBtn: id('modalCloseBtn'),
    modalCloseFooterBtn: id('modalCloseFooterBtn'),
  },
  card: {
    cardWrapper: id('card-wrapper'),
  },
};

function insertTextToModel(postData) {
  if (!Element.modal) return;
  const { title, author, date, views, category, status, excerpt, body } =
    postData;
  const {
    modalTitle,
    modalAuthor,
    modalDate,
    modalViews,
    modalCategory,
    modalStatusBadge,
    modalExcerpt,
    modalBody,
    modalEditBtn,
  } = Element.modal;

  // Populate modal content
  modalTitle.textContent = title;
  modalAuthor.textContent = author || 'Unknown';
  modalDate.textContent = date || 'N/A';
  modalViews.textContent = views > 0 ? views.toLocaleString() : '0';
  modalCategory.textContent = category || 'Uncategorized';

  // Update status badge
  modalStatusBadge.textContent = status || 'draft';
  modalStatusBadge.className = 'modal-status-badge ' + (status || 'draft');

  // Set excerpt and body (body supports HTML)
  modalExcerpt.textContent = excerpt || '';
  modalBody.innerHTML = body || '';

  // Update Edit button link
  modalEditBtn.href = 'edit-post.php?id=' + postData.id;
}

/**
 * Closes the post viewing modal with animation
 */
function closePostModal() {
  const { postModal } = Element.modal;

  if (!postModal) return;

  postModal.classList.add('closing');

  setTimeout(() => {
    postModal.classList.remove('open', 'closing');
    document.body.style.overflow = '';
  }, 300);
}

/**
 * Initialize modal event listeners (call on DOMContentLoaded)
 */
function initPostModal() {
  const { postModal, modalCloseFooterBtn, modalCloseBtn } = Element.modal;
  if (!postModal) return;

  // Close button (X)
  if (modalCloseBtn) {
    modalCloseBtn.addEventListener('click', closePostModal);
  }

  // Escape key to close
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && postModal.classList.contains('open')) {
      closePostModal();
    }
  });

  // Close footer button
  if (modalCloseFooterBtn) {
    modalCloseFooterBtn.addEventListener('click', closePostModal);
  }
}

// Initialize on page load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initPostModal);
} else {
  initPostModal();
}

// fetch the blogs using API

function renderPost(posts) {
  const { cardWrapper } = Element.card;

  if (!cardWrapper) return;

  cardWrapper.innerHTML = posts
    .map(
      (post) => `<div class="card" id="card-post">
    <img src="http://localhost/php_sandbox_2/final_project/assets/file_uploads/${post.featured_image}" alt="Post Image" />
    <p class="blog nation">${post.category}</p>

    <div class="cardContent">
      <div class="cardDate">
        <p>${post.created_at}</p>
        <p>.</p>
        <p>10 mins read</p>
      </div>
      <div class="cardDetails">
        <h1 class="blogTitle post-btn" data-post="${post.id}">${post.title}</h1>
        <p class="blogContent">${post.excerpt}</p>
        <div class="user">
          <img src="./assets/img/img9.jpg" alt="" />
          <p class="userName">${post.author}</p>
        </div>
      </div>
    </div>
  </div>`
    )
    .join('');

  cardWrapper.addEventListener('click', (e) => {
    const btn = e.target.closest('.post-btn');
    if (!btn) return;

    const postId = btn.dataset.post;
    const post = posts.find((p) => String(p.id) === postId);

    if (post) {
      insertTextToModel(post);
      Element.modal.postModal.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
  });
}

async function fetchPost() {
  // REMEMBER TO CHANGE THIS API LINK TO YOUR LOCALHOST LINK

  const url = 'http://localhost/php_sandbox/MyFinalProject/api/';

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Error occurred: ${response.status}`);
    }
    const data = await response.json();
    renderPost(data);
  } catch (error) {
    console.error(error.message);
  }
}
document.addEventListener('DOMContentLoaded', fetchPost);
