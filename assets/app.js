/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

require('bootstrap');


/*
* Below is the code to reveal elements when they are in the viewport
* The classes "reveal-" are defined in the styles/modules/homeAnim.scss file
* The class "reveal-1" and "reveal-2" are applied to elements in the file templates/home/index.html.twig
* When at least 10% (ratio) of the element targeted is visible, the class "reveal-visible" is added to the element
 */
const ratio = .1
const options = {
    root: null,
    rootMargin: "0px",
    threshold: ratio,
};

const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.add("reveal-visible")
            observer.unobserve(entry.target)
        }
    })
}

const observer = new IntersectionObserver(handleIntersect, options)
document.querySelectorAll('[class*="reveal-"]').forEach(function (r) {
    observer.observe(r)
})
// End of the code to reveal elements when they are in the viewport
