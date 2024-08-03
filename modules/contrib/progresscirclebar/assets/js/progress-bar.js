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
        var valueContainer = el.querySelector('.progress-bar__value');
        var progressValue = 0;
        var progressEndValue = valueContainer.textContent;
        el.style.backgroundColor = drupalSettings.bar_wrapper_color;

        var progress = setInterval(
            function () {
                progressValue += 1;
                valueContainer.style.backgroundColor = drupalSettings.bar_val_color;
                valueContainer.textContent = progressValue + '%';
                valueContainer.style.width = (progressValue) + "%";
                if (progressValue === Number(progressEndValue)) {
                    clearInterval(progress);
                }
            }, speed
        );
    };

    /**
     * Attaches the progressBar behavior to Progress Bar field.
     *
     * @type {Drupal~behavior}
     *
     * @prop {Drupal~behaviorAttach} attach
     *   Attaches the progress animation behavior for progress field.
     */
    Drupal.behaviors.progressBar = {
        attach: function attach(context)
        {
            once('animate', '.progress-bar__wrapper', context).forEach(init);
        }
    };
})(Drupal, once, drupalSettings);
