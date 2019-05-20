<?php

function product_options() {
	global $product;

	$product_id = $product->get_id();
	

	$product_flavors = wc_get_product($product_id);
	//pr($product_flavors);

	if (!empty ($product_flavors)) {
		$terms = get_terms( array(
			'taxonomy' => 'pa_flavors',
			'hide_empty' => 'false',
		));
	}

	//pr($terms);

	echo '<h2 class="product-options__subtitle">1. Choose flavour</h2>';
	
	echo '<div class="flavor-selectors">';

		$data = array();
		foreach ( $terms as $key => $val ) {
			$term_shade_1 = get_field('color_shade_1', $val->taxonomy . '_' . $val->term_id);
			$term_shade_2 = get_field('color_shade_2', $val->taxonomy . '_' . $val->term_id);
			$term_shade_3 = get_field('color_shade_3', $val->taxonomy . '_' . $val->term_id);
			$bottle = get_field('bottle', $val->taxonomy . '_' . $val->term_id);
			$subline = get_field('subline', $val->taxonomy . '_' . $val->term_id);
			echo '<div id="' . $val->taxonomy . '_' . $val->slug . '" class="flavor-selector" data-target="' . $val->taxonomy . '" data-val="'. $val->slug .'">';
			echo '<div id="' . $val->term_id . '" class="flavor-selector__color" style="background: linear-gradient(to bottom, ' . $term_shade_1 . ' 0%, ' . $term_shade_1 . ' 33.333%,' . $term_shade_2 . ' 33.333%,' . $term_shade_2 . ' 66.666%, ' . $term_shade_3 . ' 66.666%, ' . $term_shade_3 . ' 100%);"></div>';
			echo '<div class="flavor-selector__label">' . $val->name . '</div>';
			echo '</div>';

			$data[] = array(
				'color_1' => $term_shade_1,
				'color_2' => $term_shade_2,
				'color_3' => $term_shade_3,
				'title' => $val->name,
				'bottle' => $bottle,
				'subline' => $subline
			);
		}

	echo '</div>';

	echo '<div class="product-options__line"></div>';

	echo '<h2 class="product-options__subtitle">2. Select amount</h2>';

	echo '<div class="product-options__quantity">
					<div class="quantity-label"></div>
					<div id="quantity-dropdown" class="quantity-dropdown" data-target="pa_quantity">
						<div class="quantity-dropdown__button">&nbsp;</div>
						<ul class="quantity-dropdown__list"></ul>
					</div>

				</div>';

	//pr($data);

	?>

	<script>
		const quantityLabel = document.querySelector('.quantity-label');
		
		document.addEventListener("DOMContentLoaded", colorsInit);
		document.addEventListener("DOMContentLoaded", getFormData);

		function colorsInit() {
			const colorPickers = document.querySelectorAll('.flavor-selector');

			colorPickers.forEach(function(item, i) {
				document.getElementById(item.id).addEventListener('click', (e) => {
					syncDropdown(e);
					switchGalleryBgColor(e);
					switchActivePicker(e);
					switchActiveBottle(e);
					//getFormData();
				});
			});

			
			const currentFlavorSelect = document.querySelector('#pa_flavors');
			const currentFlavor = currentFlavorSelect.value;
			const currentFlavorTitle = currentFlavorSelect.options[currentFlavorSelect.selectedIndex].text;
			
			const quantityDropdown = document.querySelector('.product-options__quantity-dropdown');
			
			// set current picker
			const currentPicker = document.querySelector('.flavor-selector[data-val="' + currentFlavor + '"]').classList.add('active');

			// set current label for quantity select
			quantityLabel.innerHTML = currentFlavorTitle;
			
			// set gallery initial background 
			document.querySelector('.b-single-product__bg_' + currentFlavor ).style.opacity = 1;

			// set angle for bottle
			document.querySelector('.b-single-product__bottle-' + currentFlavor ).classList.add('active');
		}

		/* synchronize default flavor dropdown with flavor pickers */
		function syncDropdown(e) {
			const target = e.currentTarget.dataset.target;
			const selectVal = e.currentTarget.dataset.val;

			const select = document.getElementById(target);
			select.value = selectVal;

			const event = new Event("change", {bubbles: true, cancelable: false});
  		select.dispatchEvent(event);
		}

		function setQuantityLabel(e) {
			quantityLabel.innerHTML = activePicker.querySelector('.flavor-selector__label').innerHTML;
		}

		function switchGalleryBgColor(e) {
			const selectVal = e.currentTarget.dataset.val;
			const allPickers = document.querySelectorAll('.b-single-product__bg');
			allPickers.forEach(function(item) {
				item.style.opacity = 0;
			});
			document.querySelector('.b-single-product__bg_' + selectVal).style.opacity = 1;
		}

		function switchActivePicker(e) {
			if (e.currentTarget.classList.contains('active')) {
				return;
			}

			const selectVal = e.currentTarget.dataset.val;
			const activePicker = document.querySelector('.flavor-selector.active');
			activePicker.classList.remove('active');
			
			document.querySelector('.flavor-selector[data-val="' + selectVal + '"]').classList.add('active');
		}

		function switchActiveBottle(e) {
			const selectVal = e.currentTarget.dataset.val;
			const activeBottle = document.querySelector('.b-single-product__bottle.active');
			activeBottle.classList.remove('active');
			
			document.querySelector('.b-single-product__bottle-' + selectVal ).classList.add('active');
		}

		function getFormData() {
			const data = document.querySelector('.variations_form').dataset.product_variations;
			buildDropdown(data);
		}

		function buildDropdown(data) {
			let newData = JSON.parse(data);

			const currentFlavor = document.querySelector('#pa_flavors').value;
			const currentQuantity = document.querySelector('#pa_quantity').value;
			const quantityDropdownList = document.querySelector('.quantity-dropdown__list');
			const quantityDropdownButton = document.querySelector('.quantity-dropdown__button');
			
			quantityDropdownButton.innerHTML = currentQuantity;

			let flavorArr = newData.filter(function(item) {
				if (item.attributes.attribute_pa_flavors === currentFlavor) {
					return item;
				} 
			});

			let dropdownOptions = flavorArr.map(function(item, index) {
				let quantityName = item.attributes.attribute_pa_quantity.replace('-', ' ');
				let quantityPrice = item.price_html.replace('woocommerce-Price-amount amount', 'quantity-dropdown__price');

				if (index === 0) {
					quantityDropdownButton.innerHTML = '<span class="quantity-dropdown__label">'+ quantityName +' - ' + quantityPrice + '</span>';
					return '<li class="active" data-val="' + item.attributes.attribute_pa_quantity + '"><span class="quantity-dropdown__label">'+ quantityName +' - ' + quantityPrice + '</span></li>';
				}
				else {
					return '<li data-val="' + item.attributes.attribute_pa_quantity + '"><span class="quantity-dropdown__label">'+ quantityName +' - ' + quantityPrice + '</span></li>';
				}
			});

			quantityDropdownList.innerHTML = dropdownOptions.join('');
			

			//console.log(JSON.parse(data));

			// custom dropdown
			document.getElementById('quantity-dropdown').addEventListener('click', showDropdown);
		}

		// custom dropdown
		function showDropdown(e) {
			const clickedElem = e.target;
			const currentDropdown = clickedElem.closest('.quantity-dropdown');
			const targetSelect = currentDropdown.dataset.target;
			const currentLabel = currentDropdown.querySelector('.quantity-dropdown__button');
			let currentVal;

			currentDropdown.classList.toggle('active');

			if (clickedElem.tagName === 'LI') {
				currentLabel.innerHTML = clickedElem.innerHTML;
				currentVal = clickedElem.dataset.val;

				const allItems = currentDropdown.querySelectorAll('li');
				allItems.forEach(function(item) {
					if (item.classList.contains('active')) {
						item.classList.remove('active');
					}
				});
				clickedElem.classList.add('active');

				syncQuantityDropdown(targetSelect, currentVal);
			}

			window.onclick = function (e) {
 		 	if (!e.target.classList.contains('quantity-dropdown__button')) {
    		currentDropdown.classList.remove('active');
  			}
			}
		}

		function syncQuantityDropdown(target, val) {
			const select = document.getElementById(target);
			select.value = val;

			const event = new Event("change", {bubbles: true, cancelable: false});
  		select.dispatchEvent(event);
		}

	</script>

	<?php
}

add_action('woocommerce_single_product_summary', 'product_options', 10);



