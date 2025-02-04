nbr_click = 0;

function createHearts() {
    const container = document.body;
    const numHearts = Math.floor(Math.random() * 10) + 5;
  
    for (let i = 0; i < numHearts; i++) {
        const heart = document.createElement("div");
        heart.classList.add("heart");
        heart.style.display = "block";
        heart.style.left = `calc(${Math.random() * 100}vw - 50px)`;
        heart.style.animationDuration = `${Math.random() * 3 + 2}s`;
        container.appendChild(heart);
    }
}

function display_hearts() {
    if (nbr_click < 7) {
        createHearts();
    }
    nbr_click++;
}
