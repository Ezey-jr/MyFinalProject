<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";
require_once "Core/Auth.php";
require_once "Controller/PostController.php";
// start session everytime
Session::start();
Auth::login_redirect();

$user_type = Auth::user()->user_type == 1 ? "Administrator" : "Moderator";

$total_posts = count(PostController::index());
?>

<!-- posts.php -->
<?php
// ── DB connection will go here ──
// $conn = new mysqli("localhost", "user", "password", "blog_db");

// ── Sample data (replace with real DB query) ──
// $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
// $posts = $result->fetch_all(MYSQLI_ASSOC);

$posts = PostController::index() ;

$status_badge = [
  "published" => "badge-published",
  "draft"     => "badge-draft",
  "archived"  => "badge-archived",
];
?>

<?php $page_title = "Edit Post" ?>

<?php include_once "views/layouts/header.php" ?>
<?php include_once "views/components/update.php" ?>



  <main class="page-content">
    <div class="page-header">
      <div>
        <div class="page-heading">All Posts</div>
        <div class="page-sub"><?php echo count($posts); ?> posts total</div>
      </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
      <div class="search-wrap">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" class="search-input" id="searchInput" placeholder="Search posts…">
      </div>
      <select class="filter-select" id="statusFilter">
        <option value="">All Statuses</option>
        <option value="published">Published</option>
        <option value="draft">Draft</option>
        <option value="archived">Archived</option>
      </select>
      <select class="filter-select" id="categoryFilter">
        <option value="">All Categories</option>
        <option value="Tutorial">Tutorial</option>
        <option value="Frontend">Frontend</option>
        <option value="Backend">Backend</option>
        <option value="Database">Database</option>
      </select>
    </div>

    <!-- Table -->
    <div class="table-wrap">
      <table id="postsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Views</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($posts as $i => $post): ?>
          <tr data-status="<?php echo $post->satus; ?>" data-category="<?php echo $post->category; ?>">
            <td style="color:var(--text-muted); font-size:.8rem;"><?php echo $post->id; ?></td>
            <td class="post-title-cell">
              <span class="title-text"><?php echo htmlspecialchars($post->title); ?></span>
              <span class="post-excerpt"><?php echo htmlspecialchars($post->excerpt); ?></span>
            </td>
            <td><span class="category-pill"><?php echo htmlspecialchars($post->category); ?></span></td>
            <td>
              <span class="badge <?php echo $status_badge[$post->status]; ?>">
                <?php echo ucfirst($post->status); ?>
              </span>
            </td>
            <td style="font-size:.85rem; color:var(--text-secondary);">
              <!-- views will be here --> 2
            </td>
            <td style="font-size:.8rem; color:var(--text-muted); white-space:nowrap;"><?php echo $post->updated_at; ?></td>
            <td>
              <div class="row-actions">
                <a href="edit-post.php?id=<?php echo $post->id; ?>" class="action-btn" title="Edit post">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                </a>
                <button class="action-btn" title="View post">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                </button>
                <button class="action-btn danger" title="Delete post"
                  onclick="confirmDelete(<?php echo $post ?>, '<?php echo addslashes($post->title); ?>')">
                  <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6"/>
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                  </svg>
                </button>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- Pagination -->
      <div class="pagination">
        <span class="pagination-info" id="paginationInfo">Showing <?php echo count($posts); ?> posts</span>
        <div class="pagination-btns">
          <button class="pg-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="15 18 9 12 15 6"/>
            </svg>
          </button>
          <button class="pg-btn active">1</button>
          <button class="pg-btn">2</button>
          <button class="pg-btn">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <polyline points="9 18 15 12 9 6"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

  </main>
</div>

<div class="toast-container" id="toastContainer"></div>

<script src="app.js"></script>
<script>
// Client-side filter (will be replaced by server-side PHP + DB filtering)
// const searchInput    = document.getElementById('searchInput');
// const statusFilter   = document.getElementById('statusFilter');
// const categoryFilter = document.getElementById('categoryFilter');

// function filterTable() {
//   const q   = searchInput.value.toLowerCase();
//   const st  = statusFilter.value;
//   const cat = categoryFilter.value;
//   const rows = document.querySelectorAll('#postsTable tbody tr');
//   let visible = 0;
//   rows.forEach(row => {
//     const title    = row.querySelector('.title-text').textContent.toLowerCase();
//     const status   = row.dataset.status;
//     const category = row.dataset.category;
//     const show = title.includes(q)
//       && (st  === '' || status   === st)
//       && (cat === '' || category === cat);
//     row.style.display = show ? '' : 'none';
//     if (show) visible++;
//   });
//   document.getElementById('paginationInfo').textContent = `Showing ${visible} post${visible !== 1 ? 's' : ''}`;
// }

// searchInput.addEventListener('input', filterTable);
// statusFilter.addEventListener('change', filterTable);
// categoryFilter.addEventListener('change', filterTable);

// function confirmDelete(id, title) {
//   if (confirm(`Delete "${title}"?\n\nThis cannot be undone.`)) {
//     // Replace with: window.location.href = `delete-post.php?id=${id}`;
//     showToast(`Post "${title}" deleted.`, 'error');
//     document.querySelector(`tr[data-status]`); // placeholder
//   }
// }

console.log("hello world");
console.log("again");
alert("guys");
</script>
<?php include_once "views/layouts/footer.php" ?>

