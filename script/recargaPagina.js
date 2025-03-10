function resetScroll() {
    // Si existe el flag "justSubmitted", lo eliminamos y no forzamos el scroll.
    if (sessionStorage.getItem("justSubmitted")) {
        sessionStorage.removeItem("justSubmitted");
    } else {
        // Remueve el hash y forzar scroll a la parte superior.
        history.replaceState(null, null, window.location.pathname);
        window.scrollTo(0, 0);
    }
}

window.addEventListener('load', resetScroll);