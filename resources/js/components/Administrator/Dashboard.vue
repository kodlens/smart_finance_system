<template>
	<div>
		<div class="section">
			<div class="columns">
				<div class="column">
					
					<div class="box">
						<div class="has-text-weight-bold is-size-5 mb-2">CURRENT FINANCIAL YEAR</div>
						@foreach($cfy as $item)
						<div class="box-card-container">
							<div class="has-text-weight-bold box-card-title">
								{{ $item->allotment_class }}
							</div>
							<div class="box-card-value">
								{{ $item->amount}}
							</div>
						</div>
						@endforeach
						

						
					</div>
				</div>

				<div class="column">
					<div class="box">
						<div class="has-text-weight-bold is-size-5 mb-2">SUPPLEMENTAL BUDGET</div>
						<div class="box-card-container">
							<div class="has-text-weight-bold box-card-title">
								PERSONAL SERVICES
							</div>
							<div class="box-card-value">
								25422
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								MOOE
							</div>
							<div class="box-card-value">
								25422
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								CAPITAL OUTLAY
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>
					</div>
				</div>

				<div class="column">
					<div class="box">
						<div class="has-text-weight-bold is-size-5 mb-2">CAPITAL OUTLAY (Continuing)</div>

						<div class="box-card-container">
							<div class="has-text-weight-bold box-card-title">
								PERSONAL SERVICES
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								MOOE
							</div>
							<div class="box-card-value">
								25422
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								CAPITAL OUTLAY
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>
					</div>
				</div>

			</div>



			<div class="columns">
				<div class="column">
					<div class="box">
						<div class="has-text-weight-bold is-size-5 mb-2">ACCOUNTS PAYABLE</div>
						<div class="box-card-container">
							<div class="has-text-weight-bold box-card-title">
								PERSONAL SERVICES
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								MOOE
							</div>
							<div class="box-card-value">
								25422
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								CAPITAL OUTLAY
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>
					</div>
				</div>
				<div class="column">
					<div class="box">
						<div class="has-text-weight-bold is-size-5 mb-2">TES TRUST FUND</div>

						<div class="box-card-container">
							<div class="has-text-weight-bold box-card-title">
								PERSONAL SERVICES
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								MOOE
							</div>
							<div class="box-card-value">
								25422
							</div>
						</div>

						<div class="box-card-container mt-4">
							<div class="has-text-weight-bold box-card-title">
								CAPITAL OUTLAY
							</div>
							<div class="box-card-value">
								25422
							
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		
	</div>
</template>

<script>
export default {

}
</script>

<style>
 /* .hero{
    background-image: url("/img/bg-hero.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}  */

	.main-page{
		height: 100vh;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-top: -80px;
		border: 1px solid blue;
	}

	.main-text{
		font-weight: bold;
		font-size: 3rem;
	}

	.box-card{
		border: 1px solid gray;
		max-width: 400px;
		padding: 15px;
	}

	.box-card-container{
		display: flex;
	}
	.box-card-title{
		color: gray;
		flex: 1;
	}
</style>