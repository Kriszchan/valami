$uri = "http://localhost:8000/api/teams"
Write-Host "Fetching teams from: $uri" -ForegroundColor Green

try {
    $response = Invoke-WebRequest -Uri $uri -Method Get -ErrorAction Stop
    $data = $response.Content | ConvertFrom-Json

    Write-Host "`nTotal teams: $($data.Count)" -ForegroundColor Yellow
    Write-Host "`nFirst 5 teams:" -ForegroundColor Yellow

    $data[0..4] | ForEach-Object {
        Write-Host "  - $($_.name) ($($_.tournament))" -ForegroundColor Cyan
    }

    Write-Host "`nAPI working successfully!" -ForegroundColor Green
} catch {
    Write-Host "Error: $_" -ForegroundColor Red
}
