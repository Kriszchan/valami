$gamesUri = "http://localhost:8000/api/games"
Write-Host "Creating a new game..." -ForegroundColor Green

$gameData = @{
    home_team_id = 1
    away_team_id = 2
    scheduled_at = "2026-03-15 15:00:00"
} | ConvertTo-Json

try {
    $response = Invoke-WebRequest -Uri $gamesUri `
        -Method Post `
        -ContentType "application/json" `
        -Body $gameData `
        -ErrorAction Stop

    $data = $response.Content | ConvertFrom-Json

    Write-Host "`nGame Created Successfully!" -ForegroundColor Green
    Write-Host "Game ID: $($data.id)" -ForegroundColor Cyan
    Write-Host "Home Team ID: $($data.home_team_id)" -ForegroundColor Cyan
    Write-Host "Away Team ID: $($data.away_team_id)" -ForegroundColor Cyan
    Write-Host "Status: $($data.current_period)" -ForegroundColor Cyan
    Write-Host "Scheduled: $($data.scheduled_at)" -ForegroundColor Cyan

    # Test update game
    Write-Host "`nUpdating game scores..." -ForegroundColor Green
    $updateUri = "$gamesUri/$($data.id)"

    $updateData = @{
        home_score = 2
        away_score = 1
        current_period = "second_half"
    } | ConvertTo-Json

    $updateResponse = Invoke-WebRequest -Uri $updateUri `
        -Method Put `
        -ContentType "application/json" `
        -Body $updateData `
        -ErrorAction Stop

    $updatedData = $updateResponse.Content | ConvertFrom-Json
    Write-Host "Score updated: $($updatedData.home_score) - $($updatedData.away_score)" -ForegroundColor Green
    Write-Host "Period: $($updatedData.current_period)" -ForegroundColor Green

} catch {
    Write-Host "Error: $_" -ForegroundColor Red
}
