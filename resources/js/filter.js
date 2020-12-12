//Vue Filter to make first letter Capital
Vue.filter("strToUpper", function(text) {

    return text.charAt(0).toUpperCase() + text.slice(1);

});

//Vue moment js to show human readable date
import moment from "moment"; //Import Moment

/**
 * Formate  date
 */
Vue.filter("formatDate", function(date) {

    return moment(date).format('MMMM Do YYYY');

});

/** Truncate text */
Vue.filter('truncate', function (text, length, suffix) {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
});
