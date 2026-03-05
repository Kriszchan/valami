$gamesUri = "http://localhost:8000/api/games"
Write-Host "Fetching games from: $gamesUri`n" -ForegroundColor Green

try {
    $response = Invoke-WebRequest -Uri $gamesUri -Method Get -ErrorAction Stop
    $data = $response.Content | ConvertFrom-Json

    Write-Host "Response:" -ForegroundColor Yellow
    Write-Host ($response.Content | ConvertFrom-Json | ConvertTo-Json -Depth 3) -ForegroundColor Cyan

    Write-Host "`nTotal games: $($data.Count)" -ForegroundColor Green

} catch {
    Write-Host "Error: $_" -ForegroundColor Red
}
