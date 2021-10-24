function doOnDocumentLoaded() {
    // Message
    const flashdata = document.querySelector('.flashdata');
    if (flashdata) {
        const toID = document.querySelector('.data-to_id');
        const message = flashdata.children;
        Swal.fire({
            icon: message[0].innerHTML,
            title: message[1].innerHTML,
            text: message[2].innerHTML,
            showConfirmButton: false,
            timer: 1500
        });
    }
}

const loaded = setInterval(async function () {
    if (document.readyState === "complete") {
        doOnDocumentLoaded();
        clearInterval(loaded);
    }
}, 500);
