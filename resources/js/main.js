import Swal from 'sweetalert2'
import { format } from 'date-fns'
import mexicoLocale from 'date-fns/locale/es'
import { listenersInputs, validateForm, runReplacers } from './helpers'


const alerta = document.querySelector('#alerta')
const fecha = document.querySelector('#fechaHoy')
const form = document.querySelector('#formulario-menu')

document.addEventListener('DOMContentLoaded', () => {
    if(fecha) fecha.innerText = format(new Date(), "EEEE, dd 'de' LLLL 'de' yyyy", { locale: mexicoLocale })

    if(form){
        listenersInputs('#formulario-menu')
        runReplacers()

        form.addEventListener('submit', e => {
            const array = [...form.elements]

            if(!validateForm(array)){
                e.preventDefault()
            } else {
                e.preventDefault()

                Swal.fire({
                    title: 'Confirmación',
                    text: "Verifica que tus datos sean correctos, ya que no se podrán actualizar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f97315',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, todo bien',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            text: 'Gracias, estamos enviando la información para guardarla, espera un momento...',
                            showConfirmButton: false,
                            timer: 3000
                        })

                        const btn = form.querySelector('#btn-submit')
                        btn.setAttribute('disabled', true)
                        btn.classList.add('disabled:opacity-70')

                        setTimeout(() => {
                            form.submit()
                        }, 2000)
                    }
                })
            }
        })

        // const btn = form.querySelector('#btn-submit')
        // if(btn){
        //     btn.addEventListener('click', confirmacion)
        // }

    }

    if(alerta) showNotification()
})

const showNotification = () => {
    let type = alerta.dataset.type.trim()
    let message = alerta.dataset.message.trim()

    if(type == 'success'){
        Swal.fire({
            icon: 'success',
            text: message,
            showConfirmButton: false,
            timer: 5000,
        })
    } else if(type == 'warning'){
        Swal.fire({
            icon: 'warning',
            text: message,
            showConfirmButton: true,
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#f8bb86'
        })
    } else if(type == 'error'){
        Swal.fire({
            icon: 'error',
            text: message,
            showConfirmButton: true
        })
    } else if(type == 'error-confirm'){
        Swal.fire({
            icon: 'error',
            text: 'Hubo un problema con tu petición',
            text: message,
            confirmButtonColor: '#e05959',
            confirmButtonText: 'Ok',
        })
    } else if(type == 'info'){
        Swal.fire({
            icon: 'info',
            confirmButtonColor: '#374151',
            confirmButtonText: 'Entendido',
            html: message
        })
    }

    // Limpiar
    alerta.dataset.type = ''
    alerta.dataset.message = ''
}

