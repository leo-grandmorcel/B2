namespace CSharpDiscovery.Quest04
{
    public class HybridCar : Car, IThermalCar, IElectricCar
    {
        public int FuelLevel { get; set; } = 100;

        public void FillUp()
        {
            FuelLevel = 100;
        }

        public int GetFuelLevel()
        {
            return FuelLevel;
        }

        public int BatteryLevel { get; set; } = 100;

        public void Recharge()
        {
            BatteryLevel = 100;
        }

        public int GetBatteryLevel()
        {
            return BatteryLevel;
        }

        public HybridCar() : base() { }

        public HybridCar(string model, string brand, string color, int currentSpeed = 0)
            : base(model, brand, color, currentSpeed) { }

        public override string ToString()
        {
            return String.Format(
                "{0} {1} {2}, Battery: {3}%, Fuel: {4}%",
                Color,
                Brand,
                Model,
                BatteryLevel,
                FuelLevel
            );
        }
    }
}
