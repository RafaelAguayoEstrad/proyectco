function getCookie(name) {
    const cookies = document.cookie.split(';')
        .map(cookie => cookie.trim())
        .filter(cookie => cookie.startsWith(name + '='));
    if (cookies.length === 0) {
        return null;
    }
    return decodeURIComponent(cookies[0].substring(name.length + 1));
}

const usuario = getCookie('usuario');

if (usuario) {
    const nav = document.querySelector('nav ul');
    const usuarioElement = document.createElement('li');
    usuarioElement.innerHTML = `<a href="#" id="usuario">${usuario}</a>`;
    nav.appendChild(usuarioElement);
}


