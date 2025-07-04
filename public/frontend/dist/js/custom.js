function chooseStar(valueStar) {
    var radios = document.getElementsByName("so_sao");
    var stars = document.getElementsByClassName("star");

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].value > valueStar) {
            stars[i].style.color = '#fff';
        }
        else {
            stars[i].style.color = '#ff9900';
        }
    }
};
