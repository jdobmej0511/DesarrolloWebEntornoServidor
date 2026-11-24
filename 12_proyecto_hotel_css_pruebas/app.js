const raiz = document.documentElement;
const barra = document.getElementById("barra");
const noche = document.getElementById("inicio");
const enlaces = document.querySelectorAll(".barra nav a");
const zonasVivas = ["ventanas", "lista-habitaciones", "lista-huespedes", "zona-reserva", "lista-reservas"];

raiz.classList.add("js");

const observadorAparicion = new IntersectionObserver((entradas) => {
    entradas.forEach((entrada) => {
        if (entrada.isIntersecting) {
            entrada.target.classList.add("visible");
            observadorAparicion.unobserve(entrada.target);
        }
    });
}, { rootMargin: "0px 0px -8% 0px" });

document.querySelectorAll(".aparece").forEach((elemento) => {
    observadorAparicion.observe(elemento);
});

const observadorMenu = new IntersectionObserver((entradas) => {
    entradas.forEach((entrada) => {
        if (entrada.isIntersecting) {
            enlaces.forEach((enlace) => {
                const activo = enlace.getAttribute("href") === `#${entrada.target.id}`;
                enlace.classList.toggle("activo", activo);
                if (activo) {
                    enlace.setAttribute("aria-current", "true");
                } else {
                    enlace.removeAttribute("aria-current");
                }
            });
        }
    });
}, { rootMargin: "-45% 0px -50% 0px" });

document.querySelectorAll("#inicio, .seccion").forEach((seccion) => {
    observadorMenu.observe(seccion);
});

let pendiente = false;

function moverEscena() {
    const alto = noche.offsetHeight;
    noche.style.setProperty("--avance", Math.min(window.scrollY / alto, 1).toFixed(3));
    barra.classList.toggle("solida", window.scrollY > alto - 90);
    pendiente = false;
}

window.addEventListener("scroll", () => {
    if (!pendiente) {
        pendiente = true;
        requestAnimationFrame(moverEscena);
    }
}, { passive: true });

moverEscena();

function actualizarPagina(html, idAviso) {
    const nueva = new DOMParser().parseFromString(html, "text/html");

    [...zonasVivas, idAviso].forEach((id) => {
        document.getElementById(id).replaceWith(nueva.getElementById(id));
    });

    zonasVivas.forEach((id) => {
        document.getElementById(id).querySelectorAll(".aparece").forEach((elemento) => {
            elemento.classList.add("visible");
        });
    });

    const aviso = document.getElementById(idAviso);
    aviso.focus({ preventScroll: true });
    return aviso.querySelector(".exito") !== null;
}

document.addEventListener("submit", async (evento) => {
    const formulario = evento.target;
    const boton = formulario.querySelector("button");
    const seccion = formulario.closest(".seccion").id;
    const idAviso = seccion === "huespedes" ? "aviso-huesped" : "aviso-reserva";

    evento.preventDefault();
    boton.disabled = true;

    try {
        const respuesta = await fetch(location.pathname, { method: "POST", body: new FormData(formulario) });

        if (!respuesta.ok) {
            throw new Error("Respuesta incorrecta");
        }

        if (actualizarPagina(await respuesta.text(), idAviso) && seccion === "huespedes") {
            formulario.reset();
        }
    } catch {
        document.getElementById(idAviso).innerHTML =
            '<p class="aviso error">No se ha podido enviar. Comprueba la conexion e intentalo de nuevo.</p>';
    } finally {
        boton.disabled = false;
    }
});

const susto = document.createElement("div");
let sonido = null;

susto.setAttribute("aria-hidden", "true");
susto.innerHTML = `
    <svg viewBox="0 0 400 500" style="height:96vh;max-width:96vw">
        <path d="M200 14c-96 0-150 74-150 176 0 66 22 112 52 146 12 14 16 34 20 62 4 34 36 74 78 74s74-40 78-74c4-28 8-48 20-62 30-34 52-80 52-146 0-102-54-176-150-176z" fill="#dfe6d2"/>
        <path d="M86 196c6-40 44-54 86-34 8 30-4 74-40 80-30 4-50-16-46-46zM314 196c-6-40-44-54-86-34-8 30 4 74 40 80 30 4 50-16 46-46z" fill="#000"/>
        <circle cx="134" cy="204" r="9" fill="#7cff00"/>
        <circle cx="266" cy="204" r="9" fill="#7cff00"/>
        <path d="M200 236l-20 62h40z" fill="#222"/>
        <path d="M128 332c20-26 124-26 144 0 8 56-22 126-72 126s-80-70-72-126z" fill="#000"/>
        <path d="M132 326L150 372L166 322L184 380L200 318L216 380L234 322L250 372L268 326ZM152 446L168 402L184 452L200 396L216 452L232 402L248 446Z" fill="#dfe6d2"/>
    </svg>`;

Object.assign(susto.style, {
    position: "fixed",
    inset: "0",
    zIndex: "100",
    display: "none",
    placeItems: "center",
    background: "#000",
    pointerEvents: "none",
});

document.body.append(susto);

function prepararSonido() {
    sonido = sonido ?? new AudioContext();
    sonido.resume();
}

document.addEventListener("pointerdown", prepararSonido);
document.addEventListener("keydown", prepararSonido);

function gritar() {
    if (sonido === null || sonido.state !== "running") {
        return;
    }

    const ahora = sonido.currentTime;
    const volumen = sonido.createGain();
    volumen.gain.setValueAtTime(0.3, ahora);
    volumen.gain.exponentialRampToValueAtTime(0.001, ahora + 1);
    volumen.connect(sonido.destination);

    [620, 655, 930].forEach((frecuencia) => {
        const oscilador = sonido.createOscillator();
        oscilador.type = "sawtooth";
        oscilador.frequency.setValueAtTime(frecuencia, ahora);
        oscilador.frequency.linearRampToValueAtTime(frecuencia * 1.7, ahora + 0.25);
        oscilador.frequency.linearRampToValueAtTime(frecuencia * 0.8, ahora + 1);
        oscilador.connect(volumen);
        oscilador.start(ahora);
        oscilador.stop(ahora + 1);
    });
}

function lanzarSusto() {
    if (document.hidden) {
        return;
    }

    susto.style.display = "grid";
    gritar();

    if (!matchMedia("(prefers-reduced-motion: reduce)").matches) {
        susto.firstElementChild.animate([
            { transform: "scale(0.7) rotate(-2deg)" },
            { transform: "scale(1.12) rotate(2deg)" },
            { transform: "scale(1) rotate(-1deg)" },
            { transform: "scale(1.05) rotate(1deg)" },
        ], { duration: 700, easing: "ease-out" });
    }

    setTimeout(() => {
        susto.style.display = "none";
    }, 1000);
}

setInterval(lanzarSusto, 10000);
