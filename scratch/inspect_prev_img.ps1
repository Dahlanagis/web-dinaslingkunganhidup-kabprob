Add-Type -AssemblyName System.Drawing
$bmp = [System.Drawing.Bitmap]::FromFile('C:\Users\Asus\.gemini\antigravity-ide\brain\0b6e8ca0-f01c-49b9-94dc-7f58b24cb5a0\.user_uploaded\media_1788835644623.png')
Write-Host "media_1788835644623: $($bmp.Width)x$($bmp.Height)"
for ($y = 0; $y -lt $bmp.Height; $y += 20) {
    $c = $bmp.GetPixel(100, $y)
    Write-Host ("y={0}: color={1}" -f $y, $c.ToString())
}
$bmp.Dispose()
