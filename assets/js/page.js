/**
 * Opens the post viewing modal with post data
 * @param {Object} postData - Post object with id, title, excerpt, body, author, date, category, status, views
 */
const modal = document.getElementById('postModal');

function insertTextToModel(postData) {
  if (!modal) return;

  // Populate modal content
  document.getElementById('modalTitle').textContent = postData.title;
  document.getElementById('modalAuthor').textContent =
    postData.author || 'Unknown';
  document.getElementById('modalDate').textContent = postData.date || 'N/A';
  document.getElementById('modalViews').textContent =
    postData.views > 0 ? postData.views.toLocaleString() : '0';
  document.getElementById('modalCategory').textContent =
    postData.category || 'Uncategorized';

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

// fetch the blogs using API
const cardWrapper = document.getElementById('card-wrapper');

function renderPost(posts) {
  cardWrapper.innerHTML = posts
    .map(
      (post) => `
  <div class="card" id="card-post">
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
      modal.classList.add('open');
      document.body.style.overflow = 'hidden';
    }
  });
}

// check line 133
// document.addEventListener('DOMContentLoaded', () => {
//   const postBtns = document.querySelectorAll('.post-btn');
//   postBtns.forEach((postBtn) => {
//     postBtn.addEventListener('click', (e) => {
//       const id = e.target.dataset.post;
//       console.log(id);
//     });
//   });
// });

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
