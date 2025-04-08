<div>
{{ form_start(form, {'attr': {'enctype': 'multipart/form-data'}}) }}
    {{ form_row(form.name) }}
    {{ form_row(form.Information) }}
    {{ form_row(form.Engine) }}
    {{ form_row(form.Transmission) }}
    {{ form_row(form.Dimension) }}
    {{ form_row(form.CyclePart) }}

    <div id="vehicle_images" data-prototype="{{ form_widget(form.newVehicleImages.vars.prototype)|e('html_attr') }}">
        {% for imageForm in form.newVehicleImages %}
            <div class="image-entry">
                {{ form_row(imageForm.image) }}
            </div>
        {% endfor %}
    </div>

    <button type="button" id="add_image">Ajouter une image</button>

    {{ form_row(form.submit) }}
{{ form_end(form) }}

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('#vehicle_images');
        const addButton = document.querySelector('#add_image');
        let index = container.querySelectorAll('.image-entry').length;

        addButton.addEventListener('click', function () {
            const prototype = container.dataset.prototype;
            const newForm = prototype.replace(/__name__/g, index);
            const div = document.createElement('div');
            div.classList.add('image-entry');
            div.innerHTML = newForm;

            container.appendChild(div);
            index++;
        });
    });
</script>
