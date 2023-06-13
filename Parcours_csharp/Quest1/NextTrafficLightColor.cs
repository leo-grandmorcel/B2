using CSharpDiscovery.Models;

namespace CSharpDiscovery.Quest01
{
    public class NextTrafficLightColor_Exercice
    {
        public static TrafficLightColor GetNextTrafficLightColor(TrafficLightColor currentColor)
        {
            if (currentColor == TrafficLightColor.Red)
            {
                return TrafficLightColor.Green;
            }
            else if (currentColor == TrafficLightColor.Green)
            {
                return TrafficLightColor.Orange;
            }
            else if (currentColor == TrafficLightColor.Orange)
            {
                return TrafficLightColor.Red;
            }
            else
            {
                return TrafficLightColor.None;
            }
        }
    }
}
