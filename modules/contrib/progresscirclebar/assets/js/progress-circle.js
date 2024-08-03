'use strict';

(function (Drupal, once, drupalSettings) {
    /**
     * Intersection observer to observer elements.
     *
     * @param {object} el
     *  The page element.
     */
    var init = function init(el)
    {
        var speed = 20;
        var valueContainer = el.querySelector('.progress-circle__value');
        var progressValue = 0;
        var progressEndValue = valueContainer.textContent;

        var progress = setInterval(
            function () {
                progressValue += 1;
                valueContainer.textContent = progressValue + '%';
                el.style.background = 'conic-gradient(\n      ' + drupalSettings.circle_val_color + ' ' + progressValue * 3.6 + 'deg,\n     ' + drupalSettings.circle_wrapper_color + ' ' + progressValue * 3.6 + 'deg\n    )';
                if (progressValue === Number(progressEndValue)) {
                    clearInterval(progress);
                }
            }, speed
        );
    };

    /**
     * Attaches the progressCircle behavior to Progress Circle field.
     *
     * @type {Drupal~behavior}
     *
     * @prop {Drupal~behaviorAttach} attach
     *   Attaches the progress animation behavior for progress field.
     */
    Drupal.behaviors.progressCircle = {
        attach: function attach(context)
        {
            once('animate', '.progress-circle__wrapper', context).forEach(init);
        }
    };
})(Drupal, once, drupalSettings);
