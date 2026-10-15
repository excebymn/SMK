const cat = document.querySelector("#cat");
const statusText = document.querySelector("#status");
const bgm = document.querySelector("#bgm");
const meow = document.querySelector("#meow");

const IMAGE_IDLE = "assets/kucing.png";
const IMAGE_PETTED = "assets/cuking.png";


const PET_DURATION = 1500;

let resetTimer = null;

bgm.volume = 0.3;
meow.volume = 0.8;


new Image().src = IMAGE_PETTED


function startBGM() {
    bgm.play().catch(() => {})
}

function setStatus(text) {
    if (statusText) {
        statusText.textContent = text
    }
}

function resetCat() {
    cat.src = IMAGE_IDLE;
    setStatus("The cat is relaxed again.")
    resetTimer = null;
}

startBGM();

cat.addEventListener("click", async () => {
    startBGM();


    cat.src = IMAGE_PETTED;
    setStatus("Meoww~ the cat feels comfy! ♡");


    clearTimeout(resetTimer);
    resetTimer = setTimeout(resetCat, PET_DURATION)


    meow.currentTime = 0;
    try {
        await meow.play();
    } catch (error) {
        console.error("Failed to play meow:", error)
        setStatus("Check the assets/meow.mp3 file")
    }
});