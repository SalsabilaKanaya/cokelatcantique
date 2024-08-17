const ItemHeaders = document.querySelectorAll(".header");
ItemHeaders.forEach(ItemHeader => {
    ItemHeader.addEventListener("click", event => {
        ItemHeader.classList.toggle("active");

        const ItemBody = ItemHeader.nextElementSibling;
        const ItemContent = ItemHeader.parentElement; // Get the parent .content element

        if(ItemHeader.classList.contains("active")){
            ItemBody.style.maxHeight = ItemBody.scrollHeight + "px";
            ItemContent.classList.add("active"); // Add active class to .content
        } else {
            ItemBody.style.maxHeight = 0;
            ItemContent.classList.remove("active"); // Remove active class from .content
        }
    });
});