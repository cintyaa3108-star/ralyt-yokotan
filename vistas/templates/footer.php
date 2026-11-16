    <footer class="rl-footer">© 2026 RALYT. Todos los derechos reservados.</footer>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="resources/js/app.js"></script>
<?php foreach (($scripts ?? []) as $s): ?><script src="<?= h($s) ?>"></script>
<?php endforeach; ?>
</body>
</html>
