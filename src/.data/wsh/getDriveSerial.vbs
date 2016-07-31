' Выводит серийник диска

Set objFSO = CreateObject("Scripting.FileSystemObject")
Set colDrives = objFSO.Drives
Set objDrive = colDrives.item("$drive")
Wscript.Echo objDrive.SerialNumber