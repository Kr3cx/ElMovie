<!-- Bootstrap Modal -->
<div class="modal fade" id="promoModal" tabindex="-1" aria-labelledby="promoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-white text-primary">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="promoModalLabel">Join the Penabur Community</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Penabur is a community website where thinkers, innovators, and professionals gather to
                    share insights, collaborate, and discuss various impactful topics.</p>
            </div>
            <div class="modal-footer">
                <a href="https://next.elmovie.site" class="btn btn-primary btn-lg px-4 py-2 ms-3">Join Now</a>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Delay Modal -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            var promoModal = new bootstrap.Modal(document.getElementById('promoModal'));
            promoModal.show();
        }, 3000);
    });
</script>
