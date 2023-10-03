let main_panel;
let footer;

$(document).ready(function () {
    main_panel = document.getElementById('main-panel')
    console.log(main_panel.style.getPropertyValue('padding-top'))
    footer = document.getElementById('footer')
    let windowHeight = window.innerHeight
    if (windowHeight > (main_panel.offsetHeight + footer.offsetHeight)){
        footer.style.setProperty('margin-top', (windowHeight - main_panel.offsetHeight - footer.offsetHeight) + 'px');
    }
});
