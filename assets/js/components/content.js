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

    // Simule un submit quand la sélection change.
    $('select').change(() => {
            $('form').submit();
        }
    )
})