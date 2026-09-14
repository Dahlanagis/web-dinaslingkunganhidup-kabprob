Add-Type -AssemblyName System.Drawing
$bmp = [System.Drawing.Bitmap]::FromFile('C:\Users\Asus\.gemini\antigravity-ide\brain\0b6e8ca0-f01c-49b9-94dc-7f58b24cb5a0\.user_uploaded\media_1788836229863.png')

for ($y = 0; $y -le 30; $y += 5) {
    $c = $bmp.GetPixel(500, $y)
    Write-Host ("y={0:D2}: #{1:X2}{2:X2}{3:X2}" -f $y, $c.R, $c.G, $c.B)
}
$bmp.Dispose()
