<!DOCTYPE html>
<html>
<head>
    <title>Verificar e Remover Links Duplicados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Verificar e Remover Links Duplicados</h2>
        <form method="post">
            <div class="form-group">
                <label for="linksTextarea">Insira os links aqui, um por linha</label>
                <textarea id="linksTextarea" name="links" class="form-control" rows="10" cols="50" placeholder="Insira os links aqui, um por linha"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Remover Duplicados</button>
        </form>

        <?php
        function removeDuplicates($links)
        {
            $uniqueLinks = array_unique(
                array_map("trim", preg_split("/\R|\s+/", $links))
            );
            return $uniqueLinks;
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["links"])) {
                $rawLinks = $_POST["links"];
                $links = array_filter(
                    preg_split("/\R|\s+/", $rawLinks),
                    "trim"
                );

                $numLinksBefore = count($links);

                if ($numLinksBefore > 0) {
                    $uniqueLinks = removeDuplicates($rawLinks);
                    $numLinksAfter = count($uniqueLinks);

                    echo "<h3 class='mt-4'>Resultado:</h3>";
                    echo "<p><strong>Quantidade de Links antes do tratamento:</strong> $numLinksBefore</p>";
                    echo "<p><strong>Quantidade de Links após o tratamento:</strong> $numLinksAfter</p>";
                    echo "<h3>Links Únicos:</h3>";
                    echo "<ul>";
                    foreach ($uniqueLinks as $link) {
                        echo "<li><a href='$link' target='_blank'>$link</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p class='mt-4'>Nenhum link válido foi fornecido.</p>";
                }
            }
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
