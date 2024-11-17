const buttons = document.querySelectorAll('.getMAIN');
const contentItems = document.querySelectorAll('.main-branch');
const mainOriginal = document.querySelector('.main-original');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        const target = button.getAttribute('data-target');

        // Esconde o elemento inicial
        mainOriginal.style.display = 'none';

        contentItems.forEach(item => {
            if (item.classList.contains(target)) {
                item.style.display = 'flex'; // Exibe o conteúdo desejado
            } else {
                item.style.display = 'none'; // Esconde os outros conteúdos
            }
        });
    });
});
