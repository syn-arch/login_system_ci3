$(function () {

	function getSubtotal(){
		let total_bayar = 0;
		$(document).find('.total_harga').each(function(index, element){
			total_bayar += Number($(element).val());
		});

		return total_bayar;
	}

	$('.btn-tambah-det').click(function(e){
		e.preventDefault();
		paket = $('.paket').val();
		qty = $('.qty').val();

		$.get(base_url + 'paket/get_paket/' + paket, function(response){
			const data = JSON.parse(response);

			const find = $(document).find('tr[data-id="'+data.id_paket+'"]');

			if (find.length == 0) {
				$('.det-transaksi').append(`
					<tr data-id="${data.id_paket}">
						<input type="hidden" name="id_paket[]" value="${data.id_paket}">
						<td>${data.nama_paket}</td>
						<td>${data.harga}</td>
						<td><input readonly class="form-control" name="qty[]" value="${qty}"></td>
						<td><input readonly class="form-control total_harga" name="total_harga[]" value="${Number(qty) * Number(data.harga)}"></td>
						<td><textarea class="form-control" placeholder="Keterangan" name="keterangan[]"></textarea></td>
						<td><a class="btn btn-hapus btn-danger"><i class="fa fa-trash"></i></a></td>
					</tr>
				`);
			}

			$('.total_bayar').val(getSubtotal());
		});

	});


	$(document).on('click', '.btn-hapus', function(){
		$(this).closest('tr').remove();
		$('.total_bayar').val(getSubtotal());
	});

	$('.biaya_tambahan').keyup(function(){
		biaya_tambahan = $(this).val()
		total_bayar = getSubtotal();

		$('.total_bayar').val(Number(total_bayar) + Number(biaya_tambahan));
	});

	$('.pajak').keyup(function(){
		pajak = $(this).val()
		biaya_tambahan = $('.biaya_tambahan').val()
		total_bayar = getSubtotal();

		$('.total_bayar').val(Number(total_bayar) + Number(pajak) + Number(biaya_tambahan));
	});

	$('.diskon').keyup(function(){
		diskon = $(this).val()
		pajak = $('.pajak').val()
		biaya_tambahan = $('.biaya_tambahan').val()
		total_bayar = getSubtotal();

		rpdiskon = Number(diskon)/100 * (Number(total_bayar) + Number(pajak) + Number(biaya_tambahan));

		$('.total_bayar').val(Number(total_bayar) + Number(pajak) + Number(biaya_tambahan) - rpdiskon);
	});

	$('.cash').keyup(function(){
		cash = $(this).val()
		total_bayar = $('.total_bayar').val()

		$('.kembalian').val(Number(cash) - Number(total_bayar));
	});

});