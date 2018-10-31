<table class="table">
	<tr>
		<th>S.No</th>
		<th>Name</th>
		<th>GSM No</th>
		<th> LGA </th>
		<th> Sattelement </th>


		<th>
			<label class="checkbox-inline">
				<input type="checkbox" class="checkbox checked" id="check"> Payment this month
			</label></th>
			<th> All additional payment </th>
			<th> Monthly Payment </th>
			<th> Other monthly payment  </th>
			<th> Total </th>


		</tr>
		<?php  $count=0; ?>
		@foreach($data as $row)
		<tr data-val="{{ $row->id }}">
			<td>{{ $loop->iteration }}</td>
			<td>{{ $row->fname." ".$row->lname }}</td>
			<td>{{ $row->gsm_no }}</td>
			<td> {{ \App\Model\Lga::find($row->lga)->lga_name }} </td>
			<td> {{ $row->setellment }}</td>

			<td><input type="checkbox" name="cust_id[]" class="select checked"  value="{{$count.'_'.$row->id}}"></td>

			<td> <input id="additional1_{{ $row->id }}" class="form-control additional1" name="additional1[]" type="text" /> </td>

			<td id="amount_{{ $row->id }}">{{ $row->pay_amt }} </td>
			<td> <input onkeyup="get_total({{ $row->id }})" id="additional_{{ $row->id }}" class="form-control" name="additional[]" value="0"/> </td>
			<td > <div id="td_{{ $row->id }}"> {{ $row->pay_amt }}</div>

			<input name="total[]" value="{{ $row->pay_amt }}" id="total_{{ $row->id }}"
			type="hidden" class="total" />

			</td>

		</tr>
		<?php $count++ ?>
		@endforeach
	</table>
	<script>
		$( '#check' ).on('click', function () {
			$( '.select' ).prop('checked', this.checked);
		});

		$(document).ready(function(){
        	$('.additional1').change(function(){
        		$('.additional1').val($(this).val());
        		$('tr').each(function() {

        			var id = $(this).attr('data-val');
        			get_total(id);
        		});
        	})
        });
		

        function get_total(id)
        {
           var additional1_val=$("#additional1_"+id).val();
           var additional_val=$("#additional_"+id).val();
           var monthly_val = $("#amount_"+id).html();

           var total = Number(additional1_val)+Number(additional_val)+Number(monthly_val);

           $("#td_"+id).html(total);
           $("#total_"+id).val(total);




        }


	</script>