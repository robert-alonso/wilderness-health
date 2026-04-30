/* ============================================================
   Wilderness Health — Infographic Shortcode JavaScript
   ============================================================ */
(function () {
    'use strict';

    document.querySelectorAll('.wh-infographic').forEach(function (section) {
        var stage      = section.querySelector('.wh-infographic__stage');
        var initToggle = section.querySelector('.wh-infographic__initiatives-toggle');
        var initContent= section.querySelector('.wh-infographic__initiatives-content');

        if (!stage) return;

        var items = Array.from(stage.querySelectorAll('.wh-infographic__item'));

        /**
         * positions[i] = current visual position of item i
         *   0 = left  |  1 = center (active)  |  2 = right
         */
        var positions = items.map(function (_, i) { return i; });

        /* ── Rotate so the clicked item becomes center ── */
        function rotateToCenter(clickedIndex) {
            var currentPos = positions[clickedIndex];
            if (currentPos === 1) return; // already active

            var shift = 1 - currentPos; // +1 if clicked left, -1 if clicked right

            positions = positions.map(function (pos) {
                return (pos + shift + 3) % 3;
            });

            applyPositions();

            // If INITIATIVES panel is open, refresh it with the new active item's list
            if (initContent && initContent.classList.contains('is-open')) {
                renderInitiativesList();
            }
        }

        /* ── Apply position attrs + swap triangle images ── */
        function applyPositions() {
            items.forEach(function (item, i) {
                var pos = positions[i];
                item.setAttribute('data-pos', pos);

                var img = item.querySelector('.wh-infographic__tri-img');
                if (!img) return;

                if (pos === 1) {
                    img.src = item.dataset.srcCenter || img.src;
                } else {
                    img.src = item.dataset.srcSide || img.src;
                }
            });
        }

        /* ── Build a clean <ul> from the active item's hidden data list ── */
        function renderInitiativesList() {
            if (!initContent) return;

            var activeIndex = positions.indexOf(1);
            var activeItem  = items[activeIndex];
            if (!activeItem) return;

            var dataList = activeItem.querySelector('.wh-infographic__data-list');
            if (!dataList) return;

            var ul = document.createElement('ul');
            ul.className = 'wh-infographic__initiatives-list';

            Array.from(dataList.querySelectorAll('li')).forEach(function (li) {
                var newLi = document.createElement('li');
                newLi.textContent = li.textContent;
                ul.appendChild(newLi);
            });

            initContent.innerHTML = '';
            initContent.appendChild(ul);
        }

        /* ── Click / keyboard on items ── */
        items.forEach(function (item, i) {
            item.addEventListener('click', function () {
                rotateToCenter(i);
            });

            item.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    rotateToCenter(i);
                }
            });
        });

        /* ── INITIATIVES accordion toggle ── */
        if (initToggle && initContent) {
            initToggle.addEventListener('click', function () {
                var expanded = initToggle.getAttribute('aria-expanded') === 'true';

                if (!expanded) {
                    // Opening: render list for current active item first
                    renderInitiativesList();
                }

                var opening = !expanded;
                initToggle.setAttribute('aria-expanded', String(opening));
                initContent.classList.toggle('is-open', opening);
                initContent.setAttribute('aria-hidden', String(!opening));

                // Close when clicking outside
                if (opening) {
                    document.addEventListener('click', outsideClickHandler);
                } else {
                    document.removeEventListener('click', outsideClickHandler);
                }
            });
        }

        function outsideClickHandler(e) {
            if (!section.contains(e.target)) {
                initContent.classList.remove('is-open');
                initContent.setAttribute('aria-hidden', 'true');
                if (initToggle) initToggle.setAttribute('aria-expanded', 'false');
                document.removeEventListener('click', outsideClickHandler);
            }
        }
    });
})();

