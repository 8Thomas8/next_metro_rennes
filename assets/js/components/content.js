import '../../scss/components/content.scss';
import $ from 'jquery';

$().ready(() => {
    // Applique le style du placeholder et des options.
    let optionsElts = $('select > option');
    for (let i = 0; i < optionsElts.length; i++) {
        if (i === 0) {
            $(optionsElts[i]).css('display', 'none');
        } else {
            $(optionsElts[i]).css('font-size', '18px').css('color', 'black')
        }
    }

    // Une fois le premier select modifié, passage au suivant.
    $('.first-input').change(() => {
            $('.first-step').hide();
            $('.second-step').show();
        }
    );

    // Simule un submit quand la sélection change sur la destination.
    $('.second-step').change(() => {
            $('form').submit();
        }
    );

    // Gestion du bouton de changement de station
    $('#edit-link').click(() => {
        window.history.back();
    });

    // Decompte
    let time = $('#time')[0].innerText;
    let min = parseInt(time.slice(0, 2));
    let sec =  parseInt(time.slice(3, 5));

    // TODO: Besoin de la date complete
    const countDownDate = new Date(0, 0, 0, 0, min, sec).getTime();


    let x = setInterval(function() {

        const now = new Date().getTime();

        const distance = countDownDate - now;

        // Calcule pour les différentes unités de temps
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        $('#time').text(minutes + ":" + seconds);
        // If the count down is finished, write some text

        // if (distance < 0) {
        //     clearInterval(x);
        //     $('#time').text("Trop tard");
        // }

    }, 1000);


})