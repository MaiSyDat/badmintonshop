// open menu
const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId);

    toggle.addEventListener("click", () => {
        nav.classList.toggle("show-menu");

        toggle.classList.toggle("show-icon");
    });
};

showMenu("nav-toggle", "nav-menu");

// dropdowm menu
const dropdownItems = document.querySelectorAll(".dropdown__item");
// select each dropdown item
dropdownItems.forEach((item) => {
    const dropdownButton = item.querySelector(".dropdown__button");
    // 2 Select each button click
    dropdownButton.addEventListener("click", () => {
        const showDropdown = document.querySelector(".show-dropdown");
        // call the toggleItem func
        toggleItem(item);

        if (showDropdown && showDropdown != item) {
            toggleItem(showDropdown);
        }
    });
});

// Create a function to display
const toggleItem = (item) => {
    const dropdownContainer = item.querySelector(".dropdown__container");

    if (item.classList.contains("show-dropdown")) {
        dropdownContainer.removeAttribute("style");
        item.classList.remove("show-dropdown");
    } else {
        dropdownContainer.style.height = dropdownContainer.scrollHeight + "px";
        item.classList.add("show-dropdown");
    }
};

const mediaQuery = matchMedia("(min-width: 1118px)");
const dropdownContainer = document.querySelectorAll(".dropdown__container");

const removeStyle = () => {
    if (mediaQuery.matches) {
        dropdownContainer.forEach((e) => {
            e.removeAttribute("style");
        });

        dropdownItems.forEach((e) => {
            e.classList.remove("show-dropdown");
        });
    }
};
