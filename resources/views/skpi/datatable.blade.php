@extends('layout.master')
@section('content')
<div class="main">
			<div class="main-control">
				<div class="container-fluid">
					<div class="row">
<table id="example" class="display" cellspacing="0" width="100%" style="margin-top: '200px';">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
    </tbody>
    </table>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	$('#example').DataTable({
	  dom: 'Bfrtip',
	  buttons: [
	    'copy', 'excel', 'pdf', 'csv'
	  ]
	} );
} );
</script>
@endsection