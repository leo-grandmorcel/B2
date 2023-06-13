namespace CSharpDiscovery.Quest04
{
    public interface IThermalCar
    {
        public int FuelLevel { get; set; }
        public void FillUp();
        public int GetFuelLevel();
    }

    public interface IElectricCar
    {
        public int BatteryLevel { get; set; }
        public void Recharge();
        public int GetBatteryLevel();
    }
}
