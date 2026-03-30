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
    <img src=${post.featured_image} alt=" Post Image" />
    <p class="blog nation">${post.category}</p>

    <div class="cardContent">
       <div class="cardDate">
        <p>${post.created_at}</p>
        <p>.</p>
        <p>10 mins read</p>
      </div>
      <div class="cardDetails">
        <h1 class="blogTitle">
          <a href="">${post.title}</a>
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
 console.log('hello')
async function fetchPost() {
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

document.addEventListener('DOMContentLoaded', () =>{
  const cardPost = document.getElementById('card-post')

  cardPost.addEventListener('click', () => {
    
  })
})