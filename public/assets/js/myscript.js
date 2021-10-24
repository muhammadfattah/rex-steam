function documentLoad() {

    const tombolSignOut = document.querySelectorAll('.tombol-signout');
    if (tombolSignOut) {
        tombolSignOut.forEach((el) => {
            el.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Sign Out',
                    text: "Do you want to sign out?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: 'gray',
                    cancelButtonColor: '#000',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        });
    }

    const tombolHapus = document.querySelectorAll('.tombol-hapus');
    if (tombolHapus) {
        tombolHapus.forEach((el) => {
            el.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Delete Game',
                    text: "Are you sure you want to delete this game? All of your data will be permanently removed from our servers forever. This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#000',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        });
    }

    const tombolSimpan = document.querySelector('.tombol-simpan');
    if (tombolSimpan) {
        tombolSimpan.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Save Game',
                text: "Are you sure you want to save this game? Please check again.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Save',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    const tombolTransactionCheckout = document.querySelector('.tombol-transaction-checkout');
    if (tombolTransactionCheckout) {
        tombolTransactionCheckout.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Checkout',
                text: "Are you sure your data is correct? Please check again.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Checkout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    const tombolAddCart = document.querySelector('.tombol-add-cart');
    if (tombolAddCart) {
        tombolAddCart.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Shopping Cart',
                text: "Are you sure you want to add this game to the shopping cart?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    const tombolDeleteCart = document.querySelectorAll('.delete-cart');
    if (tombolDeleteCart) {
        tombolDeleteCart.forEach((el) => {
            el.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Delete Item',
                    text: "Are you sure you want to delete this item from shopping cart?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#000',
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        this.submit();
                    }
                });
            });
        });
    }

    const tombolUpdateProfile = document.querySelector('.update-profile');
    if (tombolUpdateProfile) {
        tombolUpdateProfile.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Update Profile',
                text: "Are you sure you want to update your profile? Please check again.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#000',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            });
        });
    }

    const formControlFile = document.querySelectorAll('.form-control-file');
    if (formControlFile) {
        formControlFile.forEach(function (el) {
            el.addEventListener('change', function (e) {
                let fileName = this.value.split('\\').pop();
                this.dataset.title = fileName;
                this.classList.add('selected');
            });

            el.addEventListener("dragenter", function (event) {
                this.classList.add('selected');
            });

            el.addEventListener("dragleave", function (event) {
                this.classList.remove('selected');
            });
        });
    }


    function eventInputSearch() {
        if (this.value.length <= 0) {
            this.classList.add('fa');
        } else {
            this.classList.remove('fa');
        }
    }

    const inputSearch = document.querySelectorAll('.input-search');
    if (inputSearch) {
        inputSearch.forEach(function (el) {
            if (el.value.length <= 0) {
                el.classList.add('fa');
            } else {
                el.classList.remove('fa');
            }
            el.addEventListener('input', eventInputSearch.bind(el));
        });
    }


    const games = document.querySelectorAll('.games .game .background');
    if (games) {
        games.forEach(function (game) {
            const background = game.dataset.url;
            if (background) {
                game.style.background = `url(${background}) no-repeat`;
            }
        });
    }

    const detailGameCover = document.querySelector('.detail-game .cover');
    if (detailGameCover) {
        const background = detailGameCover.dataset.url;
        if (background) {
            detailGameCover.style.background = `url(${background}) no-repeat`;
        }
    }

    const checkAgeCover = document.querySelector('.check-age .cover');
    if (checkAgeCover) {
        const background = checkAgeCover.dataset.url;
        if (background) {
            checkAgeCover.style.background = `url(${background}) no-repeat`;
        }
    }

    const cartCover = document.querySelectorAll('.carts .cover');
    if (cartCover) {
        cartCover.forEach(function (game) {
            const background = game.dataset.url;
            if (background) {
                game.style.background = `url(${background}) no-repeat`;
            }
        });
    }

    const profile = document.querySelector('.profile .content .information .image');
    const changeProfile = document.querySelector('.profile .content .information .image #change-profile');
    if (profile) {
        profile.addEventListener('click', function () {
            changeProfile.click();
        });
    }

    if (changeProfile) {
        changeProfile.addEventListener('change', function () {
            const [file] = this.files;
            const image = document.querySelector('.profile .content .information .image img');
            image.src = URL.createObjectURL(file);
        });
    }

    const historyCover = document.querySelectorAll('.history .transaction .cover');
    if (historyCover) {
        historyCover.forEach(function (transaction) {
            const background = transaction.dataset.url;
            if (background) {
                transaction.style.background = `url(${background}) no-repeat`;
            }
        });
    }
}

const readyStateDocument = setInterval(async function () {
    if (document.readyState === "complete") {
        documentLoad();
        clearInterval(readyStateDocument);
    }
}, 500);
