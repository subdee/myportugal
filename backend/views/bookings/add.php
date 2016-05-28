<h3>
    Create new booking
</h3>
<hr>
<?= $this->render('form', ['booking' => $booking, 'hotel' => $hotel, 'flight' => $flight]);