const btnShowForm = document.getElementById('btn-show-form');
const btnCancelForm = document.getElementById('btn-cancel-form');
const sectionForm = document.getElementById('section-form');
const formCategorie = document.getElementById('form-categorie');
const tableBody = document.getElementById('table-categories-body');

btnShowForm.addEventListener('click', () => sectionForm.classList.toggle('hidden'));
btnCancelForm.addEventListener('click', () => sectionForm.classList.add('hidden'));

const loadProducts = async () => {
    try {
        const res = await fetch('api/api.php');
        const data = await res.json();
        
        if (Array.isArray(data) && data.length > 0) {
            tableBody.innerHTML = data.map(p => `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.name}</td>
                    <td>
                        <span>${p.price} €</span>
                        <span>Size: ${p.size}</span>
                    </td>
                </tr>`).join('');
        } else {
            tableBody.innerHTML = '<tr><td colspan="3">No products found.</td></tr>';
        }
    } catch (error) {
        console.error('Error loading products:', error);
    }
};

formCategorie.addEventListener('submit', async (e) => {
    e.preventDefault();
    const payload = {
        name: document.getElementById('cat-nom').value,
        price: document.getElementById('cat-couleur').value,
        size: document.getElementById('cat-icone').value
    };

    try {
        const res = await fetch('api/api.php', { 
            method: 'POST', 
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload) 
        });
        const result = await res.json();
        if (res.ok && result.success) {
            formCategorie.reset();
            sectionForm.classList.add('hidden');
            loadProducts();
        }
    } catch (error) {
        console.error('Error submitting form:', error);
    }
});

loadProducts();