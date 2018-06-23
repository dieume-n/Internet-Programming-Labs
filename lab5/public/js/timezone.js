
let date = new Date(year, month, day, hours, minutes, seconds, milliseconds);

let timeOffset = date.getTimezoneOffset();

let timestamp = date.getTime();

let utc_timestamp = timestamp + (6000 * timeOffset);

console.log(timeOffset);
console.log(timestamp);
console.log(utc_timestamp);