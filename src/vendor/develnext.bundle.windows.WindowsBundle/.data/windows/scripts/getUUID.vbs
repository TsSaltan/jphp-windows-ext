' Выводит UUID

On Error Resume Next
Set objWMIService = GetObject("winmgmts:\\.\root\cimv2")
Set colItems = objWMIService.ExecQuery("Select * from Win32_ComputerSystemProduct",,48)
For Each objItem in colItems
    Wscript.Echo objItem.UUID
Next