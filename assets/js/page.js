
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


// const arrows = document.querySelectorAll(`.arrow`);
// const cardGroups = document.querySelectorAll(`.cardGroup`);
// const cards = document.querySelector(`.cards`);

// let current = 0;

// arrows.forEach((arrow) => {
//   arrow.addEventListener(`click`, () => {
//     if (arrow.classList.contains(`right`)) {
//       current++;
//     } else {
//       current--;
//     }

//     if (current >= cardGroups.length) {
//       current = 0;
//     }
//     if (current < 0) {
//       current = cardGroups.length - 1;
//     }

//     cards.style.transform = `translateX(-${current * 100}%)`;
//   });
// });

// fetch the blogs using API
const cardWrapper = document.getElementById('card-wrapper');

function renderPost(posts) {
  cardWrapper.innerHTML = posts
    .map(
      (post) => `
  <div class="card" id="card-post">
    <img src=http://localhost/php_sandbox_2/final_project/assets/file_uploads/${post.featured_image} alt=" Post Image" />
    <p class="blog nation">${post.category}</p>

    <div class="cardContent">
       <div class="cardDate">
        <p>${post.created_at}</p>
        <p>.</p>
        <p>10 mins read</p>
      </div>
      <div class="cardDetails">
        <h1 class="blogTitle">
          <button class="post-btn" onClick="${openPostModal(post)}"  data-post="${post.id}">${post.title}</button>
        </h1>
        <p class="blogContent">${post.excerpt}
        </p>
        <div class="user">
          <img src="./assets/img/img9.jpg" alt="" />
          <p class="userName">${post.author}</p>
        </div>
      </div>
    </div>
  </div>`
    )
    .join('');
}

// async function getPost (id){
//     const url = 
// }

// check line 133
function handleShowPost(){
    const postBtns = document.querySelectorAll(".post-btn");
    postBtns.forEach(postBtn => {
        postBtn.addEventListener('click', e =>{
            const id = e.target.dataset.post;
            
        })
    });
}
async function fetchPost() {
  const url = 'http://localhost/php_sandbox_2/final_project/api/';

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`Error occurred: ${response.status}`);
    }
    const data = await response.json();
    renderPost(data);
    handleShowPost();

  } catch (error) {
    console.error(error.message);
  }
}
document.addEventListener('DOMContentLoaded', fetchPost);
