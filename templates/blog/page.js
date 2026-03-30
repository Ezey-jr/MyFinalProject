const arrows = document.querySelectorAll(`.arrow`);
const cardGroups = document.querySelectorAll(`.cardGroup`);
const cards = document.querySelector(`.cards`);


let current = 0;

arrows.forEach(arrow => {
    arrow.addEventListener(`click`, ()=>{
        if (arrow.classList.contains(`right`)){
            current++;
        }else{
            current--;
        }

        if (current >= cardGroups.length) {
            current = 0;
        }
        if (current < 0) {
            current = cardGroups.length -1;
        }
        
        
        cards.style.transform =`translateX(-${current * 100}%)`;
    })
});
