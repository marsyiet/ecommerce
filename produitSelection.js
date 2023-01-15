const queryStringUrlId = window.location.search;

const leId = queryStringUrlId.slice(1);

const urlSearchParams = new URLSearchParams(queryStringUrlId);

const lesId = urlSearchParams.get("delpanier");

console.log(lesId);