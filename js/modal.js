const openModalBtn = document.getElementById('open-modal');
const closeModalBtn = document.getElementById('close-modal');
const modal = document.getElementById('modal');

// Show modal
openModalBtn.addEventListener('click', () => modal.classList.add('show-modal'));

// Hide modal
closeModalBtn.addEventListener('click', () => modal.classList.remove('show-modal'));

// Hide modal on outside click 
window.addEventListener('click', e => e.target == modal ? 
                        modal.classList.remove('show-modal') : false);