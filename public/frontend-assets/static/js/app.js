// Footer Current Year
const footerCurrentYear = () => {
    const elem = document.querySelector("#current-year");
    const currentYear = new Date().getFullYear();
    elem.textContent = currentYear;
};
footerCurrentYear();
