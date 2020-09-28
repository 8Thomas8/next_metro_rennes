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
    let timeElt = $('#time')[0];
    console.log(timeElt);

    if (timeElt !== undefined) {
        const countDownDate = new Date(parseInt(timeElt.dataset['year']), parseInt(timeElt.dataset['month']), parseInt(timeElt.dataset['day']), parseInt(timeElt.dataset['hour']), parseInt(timeElt.dataset['min']), parseInt(timeElt.dataset['sec'])).getTime();

        let x = setInterval(function () {

            const now = new Date().getTime();

            // Calcul la différence entre les 2 dates
            const distance = countDownDate - now;

            // Calcule pour les différentes unités de temps
            // const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            // const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Quand le compte arrive à 0, change l'affichage.
            if ((minutes <= 0 && seconds <= 0)) {
                clearInterval(x);
                $('#time').css('display', 'none');
                $('#timeTooLate').css('display', 'inline-block');
                return;
            }

            // Affiche le texte
            $('#time').text((("0" + minutes).slice(-2)) + ":" + (("0" + seconds).slice(-2)));

        }, 1000);
    }
})